<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\UpdateMember;
use App\Repositories\User\UserEloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    protected $_memberRepository;

    public function __construct(UserEloquentRepository $memberRepository)
    {
        $this->_memberRepository = $memberRepository;
    }

    public function profile ($id)
    {
        $member = $this->_memberRepository->find($id);
        if ($member && Auth::id() == $id){
            $data['title_page'] = trans('home_member.profile');
            $data['member'] = $member;

            return view('home.profile', $data);
        } else {
            return redirect()->route('home');
        }
    }

    public function setting($id)
    {
        $member = $this->_memberRepository->find($id);
        if ($member && Auth::id() == $id){
            $data['title_page'] = trans('home_member.setting');
            $data['member'] = $member;

            return view('home.setting', $data);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(UpdateMember $request, $id)
    {
        $member = $this->_memberRepository->find($id);
        if ($member && Auth::id() == $member->id) {
            $dataUpdate = [
                'name' => $request->input('name'),
                'birthday' => Carbon::parse($request->input('birthday')),
            ];
            if ($request->input('password') != '') {
                $dataUpdate['password'] = bcrypt($request->input('password'));
            }
            if ($request->hasFile('avatar')) {
                removeImageAndThumb($member->avatar);
                $dataUpdate['avatar'] = createImageAndThumb($request, 'avatar', 'users');
            }
            $this->_memberRepository->update($id, $dataUpdate);

            return redirect()->route('member.profile', [
                'id' => $member->id,
                'url' => Str::slug($member->name) . '.html',
            ])->with('success', trans('home_member.updated'));
        } else {
            return redirect()->route('home');
        }
    }
}
