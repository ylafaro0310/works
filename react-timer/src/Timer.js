import React from 'react';

class Timer extends React.Component {
    constructor(props) {
        super(props);
    
        const { radius, stroke } = this.props;
    
        this.normalizedRadius = radius - stroke * 2;
        this.circumference = this.normalizedRadius * 2 * Math.PI;
    }

    render(){
        const { onChangeTime, radius, stroke, progress, text } = this.props;
        const strokeDashoffset = this.circumference - progress / 100 * this.circumference;

        return (
            <svg
                height={radius * 2}
                width={radius * 2}
            >
                <circle
                    stroke="#3CB371"
                    fill="transparent"
                    strokeWidth={ stroke }
                    strokeDasharray={ this.circumference + ' ' + this.circumference }
                    style={ { strokeDashoffset } }
                    transform={`rotate(-90,${radius},${radius})`}
                    r={ this.normalizedRadius }
                    cx={ radius }
                    cy={ radius }
                />
                <polygon
                    points="110 160,130 160,120 140"
                    fill="#3CB371"
                    onClick={()=>{onChangeTime(3600)}}
                />
                <polygon
                    points="190 160,210 160,200 140"
                    fill="#3CB371"
                    onClick={()=>{onChangeTime(60)}}
                />
                <polygon
                    points="270 160,290 160,280 140"
                    fill="#3CB371"
                    onClick={()=>{onChangeTime(1)}}
                />
                <polygon
                    points="110 240,130 240,120 260"
                    fill="#3CB371"
                    onClick={()=>{onChangeTime(-3600)}}
                />
                <polygon
                    points="190 240,210 240,200 260"
                    fill="#3CB371"
                    onClick={()=>{onChangeTime(-60)}}
                />
                <polygon
                    points="270 240,290 240,280 260"
                    fill="#3CB371"
                    onClick={()=>{onChangeTime(-1)}}
                />
                <text 
                    x={radius} 
                    y={radius}
                    style={{fontSize: '60px'}}
                    fill='#3CB371'
                    textAnchor='middle'
                    dominantBaseline='central'
                >{text}</text>
            </svg>
        )
    }
}

export default Timer;