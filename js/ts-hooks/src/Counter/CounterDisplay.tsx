import React from "react";

type Props = {
    counter: {
        count: number,
        decrement: ()=>void,
        increment: ()=>void,
    }
}

const CounterDisplay: React.FC<Props> = ({ counter }) => {
    return (
        <div>
            <button onClick={counter.decrement}>-</button>
            <span>{counter.count}</span>
            <button onClick={counter.increment}>+</button>
        </div>
    );
}
export default CounterDisplay;