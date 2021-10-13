$(document).ready(function () {
    var myPlayListOtion = '<ul class="more_option"></ul>';
    $.ajax({
        'url': baseUrl + '/track/current' ,
        'type': 'get',
        'success': function (results) {
            if (results !== '') {
                $('.audio-player').show();
                var trackCurrent = [];
                $.each(results, function (key, val) {
                    trackCurrent.push({
                        image: val.picture,
                        title: val.name,
                        artist: val.artist,
                        mp3: val.path,
                        option: myPlayListOtion
                    });
                });
                audioPlayer(trackCurrent);
                $('.que_text').html('<i class="fa fa-angle-up" aria-hidden="true"></i> queue (' + results.length + ')');
            }
        }
    });
    // select track
    $('.weekly_play_icon').on('click', function () {
        $('#jquery_jplayer_1').jPlayer('destroy');
        var track_id = $(this).attr('id');
        $.ajax({
            'type': 'get',
            'url': baseUrl + '/' + 'track/' + track_id,
            'async': false,
            'success': function (results) {
                $('.audio-player').show();
                var tracks = [];
                $.each(results, function (key, val) {
                    tracks.push({
                        image: val.picture,
                        title: val.name,
                        artist: val.artist,
                        mp3: val.path,
                        option: myPlayListOtion
                    });
                });
                audioPlayer(tracks);
            }
        })
    });
    // add track to queue
    $('a.add_to_queue').on('click', function() {
        var track_id = $(this).attr('attr-id');
        $.ajax({
            'type': 'get',
            'url': baseUrl + '/queue/track/' + track_id,
            'async': false,
            'success': function (result) {
                $('.que_text').html('<i class="fa fa-angle-up" aria-hidden="true"></i> queue (' + result.length + ')');
                var xhtml = infoAudio(result);
                $('#mCSB_2_container ul[style]').append(xhtml);
                $('.playInQueue').on('click', function (){
                    $('#jquery_jplayer_1').jPlayer('destroy');
                    $(window).load(baseUrl + '/queue/get', function (results) {
                        results = JSON.parse(results);
                        var data = [];
                        $.each(results, function (key, value) {
                            data.push({
                                image: baseUrl + '/' + value.picture,
                                title: value.name,
                                artist: value.artist,
                                mp3: value.path,
                                option: myPlayListOtion
                            })
                        });
                        $('#jquery_jplayer_1').jPlayer('destroy');
                        audioPlayer(data);
                    });
                });
            }
        });
    });
});

function audioPlayer (data) {
    if ($('.audio-player').length) {
        var myPlaylist = new jPlayerPlaylist({
            jPlayer: '#jquery_jplayer_1',
            cssSelectorAncestor: '#jp_container_1'
        }, data, {
            swfPath: 'js/plugins',
            supplied: 'oga, mp3',
            wmode: 'window',
            useStateClassSkin: true,
            autoBlur: false,
            smoothPlayBar: true,
            keyEnabled: true,
            playlistOptions: {
                autoPlay: true
            }
        });
        $('#jquery_jplayer_1').on($.jPlayer.event.ready + ' ' + $.jPlayer.event.play, function(event) {
            var current = myPlaylist.current;
            var playlist = myPlaylist.playlist;
            $.each(playlist, function(index, obj) {
                if (index == current) {
                    $('.jp-now-playing').html("<div class='jp-track-name'><span class='que_img'><img src='" + obj.image + "'></span><div class='que_data'>" + obj.title + " <div class='jp-artist-name'>" + obj.artist + "</div></div></div>");
                }
            });
            $('.knob-wrapper').mousedown(function() {
                $(window).mousemove(function(e) {
                    var angle1 = getRotationDegrees($('.knob')),
                        volume = angle1 / 270

                    if (volume > 1) {
                        $('#jquery_jplayer_1').jPlayer('volume', 1);
                    } else if (volume <= 0) {
                        $('#jquery_jplayer_1').jPlayer('mute');
                    } else {
                        $('#jquery_jplayer_1').jPlayer('volume', volume);
                        $('#jquery_jplayer_1').jPlayer('unmute');
                    }
                });

                return false;
            }).mouseup(function() {
                $(window).unbind("mousemove");
            });
            function getRotationDegrees(obj) {
                var matrix = obj.css('-webkit-transform') || obj.css('-moz-transform') || obj.css('-ms-transform') ||  obj.css('-o-transform') || obj.css('transform');
                if(matrix !== 'none') {
                    var values = matrix.split('(')[1].split(')')[0].split(',');
                    var a = values[0];
                    var b = values[1];
                    var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
                } else { var angle = 0; }
                return (angle < 0) ? angle + 360 : angle;
            }
            var timeDrag = false;
            $('.jp-play-bar').mousedown(function(e) {
                timeDrag = true;
                updatebar(e.pageX);

            });
            $(document).mouseup(function(e) {
                if (timeDrag) {
                    timeDrag = false;
                    updatebar(e.pageX);
                }
            });
            $(document).mousemove(function(e) {
                if (timeDrag) {
                    updatebar(e.pageX);
                }
            });
            var updatebar = function(x) {
                var progress = $('.jp-progress');
                var position = x - progress.offset().left;
                var percentage = 100 * position / progress.width();
                if (percentage > 100) {
                    percentage = 100;
                }
                if (percentage < 0) {
                    percentage = 0;
                }
                $('#jquery_jplayer_1').jPlayer('playHead', percentage);
                $('.jp-play-bar').css('width', percentage + '%');
            };
            $('#playlist-toggle, #playlist-text, #playlist-wrap li a').unbind().on('click', function() {
                $('#playlist-wrap').fadeToggle();
                $('#playlist-toggle, #playlist-text').toggleClass('playlist-is-visible');
            });
            $('.hide_player').unbind().on('click', function() {
                $('.audio-player').toggleClass('is_hidden');
                $(this).html($(this).html() == '<i class="fa fa-angle-down"></i> HIDE' ? '<i class="fa fa-angle-up"></i> SHOW PLAYER' : '<i class="fa fa-angle-down"></i> HIDE');
            });
            $('body').unbind().on('click', '.audio-play-btn', function() {
                $('.audio-play-btn').removeClass('is_playing');
                $(this).addClass('is_playing');
                var playlistId = $(this).data('playlist-id');
                myPlaylist.play(playlistId);
            });
        });
    }
}

function infoAudio (result) {
    var xhtml = '';
    xhtml += '<li class="playInQueue">';
        xhtml += '<div>';
            xhtml += '<a href="javascript:;" class="jp-playlist-item-remove" style="display: none;">×</a>';
            xhtml += '<a href="javascript:;" class="jp-playlist-item jp-playlist-current" tabindex="0">';
                xhtml += '<span class="que_img">';
                    xhtml += '<img src="' + baseUrl + '/' + result.picture + '">';
                xhtml += '</span>';
                xhtml += '<div class="que_data">' + result.name;
                    xhtml += '<span class="jp-artist">by ' + result.artist + '</span>';
                xhtml += '</div>';
            xhtml += '</a>';
            xhtml += '<div class="action">';
                xhtml += '<span class="que_more">';
                    xhtml += '<img src="https://localhost/music-online/public/bower_components/package-music-online/home/images/svg/more.svg">';
                xhtml += '</span>';
                xhtml += '<span class="que_close">';
                    xhtml += '<img src="https://localhost/music-online/public/bower_components/package-music-online/home/images/svg/close.svg">';
                xhtml += '</span>';
            xhtml += '</div>';
        xhtml += '</div>';
        xhtml += '<ul class="more_option"></ul>';
    xhtml += '</li>';

    return xhtml;
}

function removeTrackInQueue(title) {
    var myPlayListOtion = '<ul class="more_option"></ul>';
    $(document).ready(function () {
        $.ajax({
            'type': 'get',
            'url': baseUrl + '/queue/delete/' + title,
            'success': function (results) {
                $('#jquery_jplayer_1').jPlayer('destroy');
                if (results.length == 0) {
                    $('.audio-player').hide();
                } else {
                    var data = [];
                    $.each(results, function (key, value) {
                        data.push({
                            image: baseUrl + '/' + value.picture,
                            title: value.name,
                            artist: value.artist,
                            mp3: value.path,
                            option: myPlayListOtion
                        })
                    });
                    audioPlayer(data);
                }
            }
        })
    });
}

