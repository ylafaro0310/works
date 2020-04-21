// Your web app's Firebase configuration
var firebaseConfig = {
apiKey: "AIzaSyDtY96Jt1pQ_aRpghj5vko8P547P0GgZ30",
authDomain: "chatapp-a2ed9.firebaseapp.com",
databaseURL: "https://chatapp-a2ed9.firebaseio.com",
projectId: "chatapp-a2ed9",
storageBucket: "",
messagingSenderId: "896301579028",
appId: "1:896301579028:web:6a429fef93610127"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const newPostRef = firebase.database();
let room = "room1";

const send = document.getElementById("send");
const username = document.getElementById("username");
const text = document.getElementById("text");
const output = document.getElementById("output");

const time = ()=>{
    var date = new Date();
    var hh = ("0"+date.getHours()).slice(-2);
    var mm = ("0"+date.getMinutes()).slice(-2);
    var ss = ("0"+date.getSeconds()).slice(-2);
    return hh + ":" + mm + ":" + ss;
}

send.addEventListener("click",()=>{
    newPostRef.ref(room).push({
        username: username.value,
        text: text.value,
        time: time(),
    });
    text.value = "";
})

newPostRef.ref(room).on("child_added",(data)=>{        
    const v = data.val();
    const k = data.key;
    let str = "";
    str += `<div id=${k} class="msg_main">`
    str += `<div class="msg_left">`
    str += `<div class="msg">`
    str += `<div class="name">${v.username}</div>`;
    str += `<div class="text">${v.text}</div>`;
    str += `</div>`
    str += `</div>`
    
    str += `<div class="msg_right">`
    str += `<div class="time">${v.time ? v.time : "--:--:--"}</div>`;
    str += `</div>`
    output.innerHTML += str;
});
