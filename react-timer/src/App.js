import React from 'react';
import './App.css';

import Timer from './Timer';

class App extends React.Component {
  constructor(props){
    super(props);
    this.state = {
      startedTime: null, // 開始時刻
      nowTime: null, // 現在時刻
      setTime: 0, // 設定時間(秒単位)
      elapsedTime: 0, // スタートが押されてからの経過時間(秒単位)
      storeElapsedTime: 0, // スタートが押される前までの経過時間(秒単位)
      setIntervalId: null, // setIntervalのid
    }

    this.countdown = this.countdown.bind(this);
    this.onStart = this.onStart.bind(this);
    this.onStop = this.onStop.bind(this);
    this.onCancel = this.onCancel.bind(this);
    this.onChangeTime = this.onChangeTime.bind(this);
  }

  countdown(){
    const { setIntervalId, startedTime, setTime, storeElapsedTime} = this.state;
    const nowTime = new Date();
    const elapsedTime = Math.floor((nowTime - startedTime) / 1000);

    const time = startedTime ? setTime - (elapsedTime + storeElapsedTime) : setTime;

    if(time === 0){
      this.setState({elapsedTime: elapsedTime});
      setTimeout(()=>{
        clearInterval(setIntervalId);
        alert('時間になりました！');
        this.setState({
          startedTime: null,
          elapsedTime: 0,
          storeElapsedTime: 0,
          setIntervalId: null,
        });  
      },10);
    }else{
      this.setState({
        elapsedTime: elapsedTime
      });
    }
  }

  onStart(){
    const id = setInterval(this.countdown,1000);
    const date = new Date();
    this.setState({
      startedTime: date,
      setIntervalId: id,
    })
  }

  onStop(elapsedTime){
    const { setIntervalId } = this.state;
    const date = new Date();
    clearInterval(setIntervalId);
    this.setState({
      startedTime: date,
      elapsedTime: 0,
      storeElapsedTime: elapsedTime,
      setIntervalId: null
    })
  }

  onCancel(){
    const { setIntervalId } = this.state;
    clearInterval(setIntervalId);

    this.setState({
      startedTime: null,
      elapsedTime: 0,
      storeElapsedTime: 0,
      setIntervalId: null,
    })
  }

  onChangeTime(sec){
    const { setTime } = this.state;
    if((setTime + sec) >= 0){
      this.setState({setTime: setTime + sec});
    }
  }

  render(){
    const { setIntervalId, startedTime, setTime, elapsedTime, storeElapsedTime } = this.state;
    const progress = startedTime ?  100 - ((elapsedTime + storeElapsedTime) / setTime * 100) : 100; 
    const time = startedTime ? setTime - (elapsedTime + storeElapsedTime) : setTime;
    const text = String('00' + Math.floor(time / 3600)).slice(-2) + ':' + String('00' + Math.floor(time / 60) % 60).slice(-2) + ':' + String('0' + time % 60).slice(-2); 

    return (
      <div className="App">
        <Timer 
          stroke={5}
          radius={200}
          progress={progress}
          text={text}
          onChangeTime={this.onChangeTime}
        />
        <div>
          <button 
            style={{marginRight: '120px'}} 
            className={'button'+(startedTime ? '' : ' button-disabled')} 
            type='button' 
            disabled={startedTime ? false : true}
            onClick={this.onCancel}
            >
              キャンセル
          </button>
          <button 
            className={'button'+(setTime === 0  ? ' button-disabled' : '')} 
            type='button'
            onClick={setIntervalId ? ()=>{this.onStop(elapsedTime + storeElapsedTime)} : this.onStart}
            disabled={setTime === 0}
          >
            {setIntervalId ? '停止' : '開始'}
          </button>
        </div>
      </div>
    );
  }
}

export default App;
