var trackList = [];
username = "davidacohen";
$.getJSON('http://ws.audioscrobbler.com/2.0/?format=json&method=user.getrecenttracks&user='+username+'&api_key=b25b959554ed76058ac220b7b2e0a026',
    function(data){
        document.write(data.recenttracks.track);            
        $.each(data.recenttracks.track, function(key, value){
            if(trackList.length === 0 || trackList[trackList.length-1].mbid != value.mbid){
                document.write(value.artist['#text'] + ' : ' + value.name + ' : ' + value.mbid + '<br />');
                trackList.push({
                    mbid: value.mbid,
                    name: value.name,
                    artist: value.artist['#text'],
                    album: value.album['#text']
                });

          }
        });
    });

    $.each(trackList, function(k,v){
        document.write(k+' '+v+'<br/>');
    });

​