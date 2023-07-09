import React from "react";
import { Col, Container, Form, FormGroup, Row, Input } from "reactstrap";

import { Radio, RadioGroup, FormControlLabel, FormControl, FormLabel } from '@mui/material';
import { AiOutlineCreditCard } from "react-icons/ai";
import stripeimg from '../../assets/images/img/stripe.png'
import { useState } from "react";
import { useSelector } from "react-redux";
import Stripe from "stripe";
import { CardElement, Elements, useElements, useStripe } from '@stripe/react-stripe-js';
import Stripeimg from '../../assets/images/img/stripepayitem.png'

import { loadStripe } from '@stripe/stripe-js';
import axiosClient from "../../axios-client";
import { toast } from "react-toastify";
import { useDispatch } from "react-redux";
import { cartActions } from "../../redux/slices/cartSlice";
import { useNavigate } from "react-router-dom";



const stripePromise = loadStripe('pk_test_51MyBGiE9CkClsfMvxELwrlj251CRM87eB6Xsm59RIezr4rvJMIqW7XVY8dPNQU0Iy2BKrbBCZC7ArZjkWwGj872p00A2KxDThC');


function CheckoutForm(props) {
    const stripe = useStripe();
    const elements = useElements();
    const dispatch = useDispatch();
    const navigate=useNavigate();

    const cartItems = useSelector((state) => state.cart.cartItems);
    const shippingCost = useSelector((state) => state.setting.shippingCost);
    const totalAmountData = useSelector((state) => state.cart.totalAmount);
    const totalAmount = parseFloat(totalAmountData)+parseFloat(shippingCost);

    const handleSubmit = async (event) => {
        event.preventDefault();
        // Use elements.getElement to get a reference to the CardElement.
        const cardElement = elements.getElement(CardElement);

        // Use the Stripe library to create a payment method.
        const result = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });


        if(result.error){
            toast.error(result.error.message,{
                theme: "colored",
                });
        }else{
            var data={
                'payment_type':'stripe',
                'shipping_info':props.shippingInfo,
                'payment_info': result,
                'order_item':cartItems,
                'total_payable':totalAmount,
                'shippingCost':shippingCost,
            }

            axiosClient
            .post('stripe/payment', data)
            .then(({ data }) => {
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
                        navigate('/user/deshboard/3')
                        dispatch(cartActions.removeCartAllItem());
                }
                
             
            });

        }


    


        // Handle the result.
    };

    return (
        <form onSubmit={handleSubmit}>
            <CardElement options={{
                style: {
                    base: {
                        fontSize: '16px',
                        marginTop: '20px',
                        color: '#424770',
                        '::placeholder': {
                            color: '#aab7c4',
                        },
                    },
                    invalid: {
                        color: '#9e2146',
                    },
                },
               hidePostalCode: true,
            }} 
            
  
            
            />
            <button type="submit" class="buy__btn w-100">Pay</button>
        </form>
    );
}




const InternationalCard = (props) => {
    const totalQty = useSelector((state) => state.cart.totalQuantity);
    const totalAmount = useSelector((state) => state.cart.totalAmount);

    const cashonDelivery = () => {

        let type = {
            type: 'stripe',
        }

        props.payment(type)

    }

    return <div>
        <Container>

            <Elements stripe={stripePromise}>
                <CheckoutForm  shippingInfo={props.shippingInfo}  />
            </Elements>

            <div className="">
                <img src={Stripeimg} />
            </div>

            {/* 
            <div>
                <h6>Internation Payment</h6>
                <br />
                <h6>Payable Amount:{totalAmount}</h6>

                <div><button class="buy__btn w-100" onClick={cashonDelivery}><span> Pay </span></button></div>
            </div> */}
        </Container>
    </div>
}
export default InternationalCard;