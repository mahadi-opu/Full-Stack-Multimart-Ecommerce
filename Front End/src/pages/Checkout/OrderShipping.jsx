import React from "react";
import { Col, Container, Form, FormGroup, Row, Input } from "reactstrap";

import { Radio, RadioGroup, FormControlLabel, FormControl, FormLabel } from '@mui/material';
import { AiOutlineCreditCard } from "react-icons/ai";
import stripeimg from '../../assets/images/img/stripe.png'
import chashon from '../../assets/images/img/cashon2.png'
import { useState } from "react";
import CashOnDelivery from "../paymentMethod.jsx/CashOnDelivery";
import InternationalCard from "../paymentMethod.jsx/InternationalCard";
import { useEffect } from "react";
import { useSelector, useDispatch } from "react-redux";


const OrderShipping = (props) => {
    const [payment, setPayment] = useState(0);
    const [shippingInfo, setShippingInfo] = useState([]);


    useEffect(() => {
        setShippingInfo(props.shippingInfo);

    }, [])
    const paymentMethod = (method) => {
        setPayment(method)
    }

    const cashonDelivery = () => {
        alert('cashondelivery')
    }

    const internationlPayment = () => {
        alert('internationlPayment')
    }



    const confirmPayment = (data) => {
        data.type === 'cashonDelivery' && cashonDelivery()
        data.type === 'stripe' && internationlPayment()

    }
    return <div>
            <div>
                <div>
                    <h6 class="mb-1 pb-3 checkout__txt "> Payment Method </h6>
                    <div className="paycard_div">
                        <div className="paymentIcon payicontop">

                            <FormControlLabel value="female" control={<Radio />} label="Cash on Delivery" onClick={() => paymentMethod(1)} />
                            <div className="imgBackground">
                                <img src={chashon} style={{ height: "21px", marginLeft: "2px", width: "55px" }} />
                            </div>
                        </div>
                        <div className="paymentIcon">
                            <FormControlLabel value="male" control={<Radio />} label="International payment" onClick={() => paymentMethod(2)} />
                            <div className="imgBackground">
                                <img src={stripeimg} />
                            </div>
                        </div>
                    </div>
                </div>
                <div className="payment__div">
                {
                    payment>0 && <div className="finalPayment">
                        {
                            payment == 1 && <CashOnDelivery payment={confirmPayment} shippingInfo={props.shippingInfo} /> || payment == 2 && <InternationalCard payment={confirmPayment} shippingInfo={props.shippingInfo} />
                        }
                    </div>
                }
                </div>
            </div>
    </div>
}
export default OrderShipping;