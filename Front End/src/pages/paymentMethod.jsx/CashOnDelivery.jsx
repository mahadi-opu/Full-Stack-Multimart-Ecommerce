import React from "react";
import { Col, Container, Form, FormGroup, Row, Input } from "reactstrap";

import { Radio, RadioGroup, FormControlLabel, FormControl, FormLabel } from '@mui/material';
import { AiOutlineCreditCard } from "react-icons/ai";
import stripeimg  from '../../assets/images/img/stripe.png'
import { useState } from "react";
import { useSelector, useDispatch } from "react-redux";
import axiosClient from "../../axios-client";
import { cartActions } from "../../redux/slices/cartSlice";
import { toast } from "react-toastify";

const CashOnDelivery = (props) => {
    const totalQty = useSelector((state) => state.cart.totalQuantity);
    const cartItems = useSelector((state) => state.cart.cartItems);

    const shippingCost = useSelector((state) => state.setting.shippingCost);
    const totalAmountData = useSelector((state) => state.cart.totalAmount);
    const totalAmount = parseFloat(totalAmountData)+parseFloat(shippingCost);
    const dispatch = useDispatch();

    const cashonDelivery=()=>{
        let type={
            type:'cashonDelivery',
        }
        props.payment(type)
    }

    const handleSubmit = async (event) => {
        event.preventDefault();
            var data={
                'payment_type':'cashOnDelivery',
                'shipping_info':props.shippingInfo,
                'payment_info': '',
                'order_item':cartItems,
                'total_payable':totalAmount,
                'shippingCost':shippingCost,
            }

    
            axiosClient
            .post('cashOnDelivery/payment', data)
            .then(({ data }) => {
                console.log(data);
                if(data.status==331){                   
                    toast.error(data.msg,{
                        theme: "colored",
                        });
                        dispatch(cartActions.deleteItem(data.id));
                    
                }
                if(data.status==400){
                    toast.error(data.msg,{
                        theme: "colored",
                        });
                        dispatch(cartActions.removeCartAllItem());
                }

               console.log(data)
                if(data.status==200){
                    toast.success(data.msg,{
                        theme: "colored",
                        });
                        dispatch(cartActions.removeCartAllItem());
                }
                
             
            });

        


    


        // Handle the result.
    };



    return <div>
                <h6>Cash on Delivery</h6>
                <br />
                <h6>Payable Amount:{totalAmount}</h6>

                <div><button class="buy__btn w-100" onClick={handleSubmit}><span> Order Confirm </span></button></div>
            </div>

}
export default CashOnDelivery;