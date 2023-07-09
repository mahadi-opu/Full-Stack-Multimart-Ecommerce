import { createSlice } from "@reduxjs/toolkit";
import axiosClient from "../../axios-client";

const getorder = () => {
  let orderitem = localStorage.getItem("ORDER_LIST");
  if (orderitem === null) {
    return [];
  } else {
    return JSON.parse(orderitem);
  }
};

const getTotalPrice = () => {
    let totalprice = localStorage.getItem("TOTAL_PRICE");
    if (totalprice === null) {
      return 0;
    } else {
      return totalprice;
    }
  };

  
const getTotalQty= () => {
    let totalQty = localStorage.getItem("TOTAL_QTY");
    if (totalQty === null || totalQty === '') {
      return 0;
    } else {
      return totalQty;
    }
  };


const initialState = {
  cartItems: getorder(),
  totalAmount: getTotalPrice(),
  totalQuantity: getTotalQty(),
};

const cartSlice = createSlice({
  name: "cart",
  initialState,
  reducers: {
    addItem: (state, action) => {
      const newItem = action.payload;
      const existingItem = state.cartItems.find(
        (item) => item.id === newItem.id && item.color === newItem.color && item.siz === newItem.siz
      );

      state.totalQuantity++;

      if (!existingItem) {
        state.cartItems.push({
          id: newItem.id,
          productName: newItem.productName,
          imgUrl: newItem.imgUrl,
          price: newItem.price,
          quantity: 1,
          totalPrice: newItem.price,
          offerId:newItem.offerId>0?newItem.offerId:0,
          color:newItem.color,
          size:newItem.siz,
        });
      } else {
        existingItem.quantity++;
        existingItem.iotalPrice = Number(existingItem) + Number(newItem.price);
      }

      state.totalAmount = state.cartItems.reduce(
        (total, item) => total + Number(item.price) * Number(item.quantity),
        0
      );
      localStorage.setItem("ORDER_LIST", JSON.stringify(state.cartItems));
      localStorage.setItem("TOTAL_PRICE",state.totalAmount);
      localStorage.setItem("TOTAL_QTY",state.totalQuantity);

      //   localStorage.removeItem("ORDER_LIST");
    },

    deleteItem: (state, action) => {

      const id = action.payload;
      const existingItem = state.cartItems.find((item) => item.id === id);

      if (existingItem) {
        state.cartItems = state.cartItems.filter((item) => item.id !== id);
        state.totalQuantity = state.totalQuantity - existingItem.quantity;
      }
      state.totalAmount = state.cartItems.reduce(
        (total, item) => total + Number(item.price) * Number(item.quantity),
        0
      );
      localStorage.setItem("ORDER_LIST", JSON.stringify(state.cartItems));
      localStorage.setItem("TOTAL_PRICE",state.totalAmount);
      localStorage.setItem("TOTAL_QTY",state.totalQuantity);
    },

    removeCartAllItem:(state, action)=>{

      state.cartItems =[];
      state.totalQuantity = '';
      state.totalAmount=0;

      localStorage.removeItem("ORDER_LIST")
      localStorage.removeItem("TOTAL_PRICE");
      localStorage.removeItem("TOTAL_QTY");
    },

    itemIncDic: (state, action) => {
        const data=action.payload;
        const id=data.id;
        const qty=data.qty;
        var totalqtset=0;

        // const id = action.payload;
        const existingItem = state.cartItems.find((item) => item.id === id);
        existingItem.quantity=qty;
  
        state.totalAmount = state.cartItems.reduce(
            (total, item) => total + Number(item.price) * Number(item.quantity),
            0
          );

          state.cartItems.map((data,index)=>{
            totalqtset+=data.quantity;
        });

        state.totalQuantity=totalqtset;
    


        localStorage.setItem("ORDER_LIST", JSON.stringify(state.cartItems));
        localStorage.setItem("TOTAL_PRICE",state.totalAmount);
        localStorage.setItem("TOTAL_QTY",state.totalQuantity);
      },
  },
});

export const cartActions = cartSlice.actions;

export default cartSlice.reducer;
