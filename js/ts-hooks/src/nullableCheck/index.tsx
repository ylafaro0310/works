import React from 'react';

interface IUser {
    name: string | null;
    age: number | undefined;
  }
  
type UserKeys = keyof IUser;

type RequiredUser = {
  [K in UserKeys]: NonNullable<IUser[K]>;
}

const user: RequiredUser = {
  name: "hoge",
  age: 14,
}