import { createSlice } from "@reduxjs/toolkit";

const islogin=()=>{
  let login = localStorage.getItem("ACCESS_TOKEN");
  if (login === null) {
    return false;
  } else {
    return true;
  }
}

const initialState = {
  isLogin: islogin(),
  token: localStorage.getItem("ACCESS_TOKEN"),
  userInfo:localStorage.getItem("USER_DATA") != null ? localStorage.getItem("USER_DATA") : [],
};

const userSlice = createSlice({
  name: "user",
  initialState,
  reducers: {
    setLoginInfo(state,action){
      const info = action.payload;
      let userdata=localStorage.setItem("USER_DATA",JSON.stringify(info.userInfo));
      state.userInfo=JSON.stringify(info.userInfo);
      state.token=localStorage.setItem("ACCESS_TOKEN",info.token);
      state.isLogin=true;
    },

    logout(state,action){
      localStorage.removeItem("ACCESS_TOKEN");
      localStorage.removeItem("USER_DATA");
      state.token=null;
      state.userInfo=[];
      state.isLogin=false;
    },
  },
});

export const userAction = userSlice.actions;
export default userSlice.reducer;
