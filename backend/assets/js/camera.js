const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const countdown = document.getElementById('countdown');
const btn = document.getElementById('btn');
var video_started = false;
var video_duration_max = 180;
var video_duration = 0;

const startCam = () => {
  if(navigator.mediaDevices.getUserMedia){
    navigator.mediaDevices
      .getUserMedia({ audio: true, video: true })
      .then((stream) => {
        video.srcObject = stream;
        window.setTimeout(takePic, 10000);
      })
      .catch(function(error){
        console.log('Something went wrong!');
      });
      video_started = true;
  }
}

const stopCam = () => {
  let stream = video.srcObject;
  let tracks = stream.getTracks();
  tracks.forEach((track) => track.stop());
  video.srcObject = null;
}

function takePic(){
  canvas.width = video.offsetWidth;
  canvas.height = video.offsetHeight;
  canvas.getContext('2d').drawImage(video, 0, 0, video.offsetWidth, video.offsetHeight);
  uploadPic();
}

function uploadPic(){
  var file = dataURLtoBlob(canvas.toDataURL('image/png'));
  var fd = new FormData;
  fd.append('image', file);
  var url = window.location.href;
  url += (url.match(/[\?]/g)?'&':'?')+'submit=video'; // append get paramter (https://stackoverflow.com/a/36068209)
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
      if(xhr.readyState === xhr.DONE){
          if(xhr.status === 200){
            console.log('success');
          }
      }
  }

  xhr.open('POST', url, true);
  xhr.send(fd);
}

function dataURLtoBlob(dataURL){
  let array, binary, i, len;
  binary = atob(dataURL.split(',')[1]);
  array = [];
  i = 0;
  len = binary.length;
  while (i < len) {
    array.push(binary.charCodeAt(i));
    i++;
  }
  return new Blob([new Uint8Array(array)], {
    type: 'image/png'
  });
}

function showCountdown(){
  video_duration++;
  var time_left = (video_duration_max - video_duration);
  var time_mins = Math.floor(time_left / 60);
  var time_secs = time_left - (time_mins*60);
  countdown.textContent = 'Time left: '+time_mins+':'+time_secs+'s';
  if(time_left <= 60){
    countdown.style.color = 'red';
  }
  if(time_left > 0){
    setTimeout(showCountdown, 1000);
  }else{
    stopCam();
    alert('Speaking Test done!');
    // TODO send sound recording to server for analyzation
    window.location = '/dashboard.php';
  }
}

btn.addEventListener('click', function(){
  startCam();
  showCountdown();
  video.style.display = 'block';
  btn.style.display = 'none';
})
