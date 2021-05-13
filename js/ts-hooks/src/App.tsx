import React, { Reducer, useState } from 'react';
import { Provider, useDispatch, useSelector } from 'react-redux';
import { AnyAction, createStore } from 'redux';
import './App.css';

interface CounterState {
  num: number
}
const initialState: CounterState = { num: 0 };

const reducer = (state=initialState, action: AnyAction) => {
  switch(action.type){
    case "decrement":
      return {...state, num: state.num - 1 };
    case "increment":
      return {...state, num: state.num + 1 };
    default:
      return state;
  }
}

const store = createStore(reducer);

type RootState = ReturnType<typeof store.getState>
type AppDispatch = typeof store.dispatch

const App = ()=>{
  return (
    <div>
      <h2>ComponentUseReactRedux</h2>
      <Provider store={store}>
        <Click/>
      </Provider>
    </div>
  )
}

const Click = ()=>{
  const num = useSelector((state: RootState)=>state.num);
  const dispatch = useDispatch<AppDispatch>();
  return (
    <div>
      <h3>Using useSelector, useDispatch</h3>
      Number: {num}
      <button onClick={()=>dispatch({type: "increment"})}>+</button>
      <button onClick={()=>dispatch({type: "decrement"})}>-</button>
    </div>
  )
}

export default App;
