const speech = new webkitSpeechRecognition();
speech.lang = "ja-JP";

const btn_start = document.getElementById("btn_start");
const btn_end = document.getElementById("btn_end");
const content = document.getElementById("content");

btn_start.addEventListener("click",()=>{
    speech.start();
    speech.onresult = (e)=>{
        console.log(e);
        speech.stop();
        const results = e.results[0];
        if(results.isFinal){
            let autotext = results[0].transcript;
            console.log(autotext);
            content.innerHTML += "<div>" + autotext + "</div>";
        }
    };
    speech.onend = ()=>{
        speech.start();
    }
});
