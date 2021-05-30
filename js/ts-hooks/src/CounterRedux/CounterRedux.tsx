import { configureStore, createSlice } from '@reduxjs/toolkit';
import React, { Reducer, useState } from 'react';
import { Provider, useDispatch, useSelector } from 'react-redux';
import { AnyAction, createStore } from 'redux';
import './App.css';

interface CounterState {
  num: number
}
const initialState: CounterState = { num: 0 };

// const reducer = (state=initialState, action: AnyAction) => {
//   switch(action.type){
//     case "decrement":
//       return {...state, num: state.num - 1 };
//     case "increment":
//       return {...state, num: state.num + 1 };
//     default:
//       return state;
//   }
// }

const slice = createSlice({
  name: 'counter',
  initialState,
  reducers: {
    decrement: (state, action: AnyAction) =>({
      ...state,
      num: state.num - 1,
    }),
    increment: (state, action: AnyAction) =>({
      ...state,
      num: state.num + 1,
    })
  }
})

const store = configureStore({
  reducer: {
    counter: slice.reducer,
  }
});

type RootState = ReturnType<typeof store.getState>
//type AppDispatch = typeof store.dispatch

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
  const num = useSelector((state: RootState)=>state.counter.num);
  return (
    <div>
      <h3>Using useSelector, useDispatch</h3>
      Number: {num}
      <button onClick={slice.actions.increment}>+</button>
      <button onClick={slice.actions.decrement}>-</button>
    </div>
  )
}

export default App;
