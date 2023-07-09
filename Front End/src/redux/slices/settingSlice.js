import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import axiosClient from "../../axios-client";

  export const  getCurrencydata= createAsyncThunk("currency",async()=>{
    const response= await  axiosClient
    .get('/currency/get')
    .then((data) => {
      return data.data ;
    });
    return response;
  })
  export const getWishcount=createAsyncThunk('wish',async()=>{

    let login = localStorage.getItem("ACCESS_TOKEN");
    if (login === null) {
      return 0;
    } else {
      const response=await axiosClient
      .get('user/wish/count')
      .then((data) => {
        return data.data
      });
      return response;
    }
  })

  export const shippingCost=createAsyncThunk('shipping',async(info)=>{
    const response=await axiosClient
    .get(`shipping/cost/get?division_id=${info.divisionId}&district_id=${info.districtId}`)
    .then((data) => {
      // console.log{data.data}
      return data.data
    });
    return response;
  })
  

const initialState = {
 currency:'',
 basepath:'http://127.0.0.1:8000',
//  basepath:'https://admin.demo.reinforcelabhosting.com/',
 loading:false,
 error:null,
 shippingCost:0,
 shippingLoading:false,
 shippingError:null,
 wishload:false,
 wishcount:0,
 wisherror:null,
};

const settingSlice = createSlice({
  name: "settingInfo",
  initialState,
  extraReducers: {
    [getCurrencydata.pending]:(state)=>{
      state.loading=true;
    },
    [getCurrencydata.fulfilled]:(state,action)=>{
      state.loading=false;
      state.currency=action.payload.currency_symbol;
    },
    [getCurrencydata.rejected]:(state,action)=>{
      state.loading=false;
      state.error=action.payload;
    },


    [shippingCost.pending]:(state)=>{
      state.shippingLoading=true;
    },
    [shippingCost.fulfilled]:(state,action)=>{
      state.loading=false;
      state.shippingCost=action.payload;
    },
    [shippingCost.rejected]:(state,action)=>{
      state.loading=false;
      state.shippingError=action.payload;
    },

    [getWishcount.pending]:(state)=>{
      state.wishload=true;
    },
    [getWishcount.fulfilled]:(state,action)=>{
      state.loading=false;
      state.wishcount=action.payload;
    },
    [getWishcount.rejected]:(state,action)=>{
      state.loading=false;
      state.wisherror=action.payload;
    }
  },
});

export const settingAction = settingSlice.actions;
export default settingSlice.reducer;