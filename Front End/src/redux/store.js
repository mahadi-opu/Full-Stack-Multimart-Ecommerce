

import { configureStore } from '@reduxjs/toolkit';
import cartSlice from './slices/cartSlice';
import userSlice from './slices/userSlice';
import settingSlice from './slices/settingSlice'



const store = configureStore ({
  reducer:{
    cart: cartSlice,
    user:userSlice,
    setting:settingSlice,
  },
});

export default store;