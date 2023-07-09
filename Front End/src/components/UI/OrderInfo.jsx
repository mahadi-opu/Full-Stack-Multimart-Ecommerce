import React from 'react'
import ProductCard from './ProductCard';
import Carousel from 'react-multi-carousel';
import '../../styles/general-product-list.css';
import { AiOutlineCreditCard,AiOutlineSafety,AiOutlineCalendar} from "react-icons/ai";
import { BsHeadset,BsTruck} from "react-icons/bs";
import "../../styles/order_info.css"



const OrderInfo = () => {



    return (
        <section className="features-wrap">
            <div className="container">
                <div className="features">
                    <div className="feature-list">
                        <div className="single-feature">
                            <div className="feature-icon">
                               <BsHeadset className='iconColor'/>
                            </div>
                            <div className="feature-details">
                                <h6>24/7 SUPPORT</h6>
                                <span>Support every time</span>
                            </div>
                        </div>
                        <div className="single-feature">
                            <div className="feature-icon">
                                <AiOutlineCreditCard className='iconColor'/>
                      
                            </div>
                            <div className="feature-details">
                                <h6>ACCEPT</h6>
                                <span>Visa, Paypal, Master</span>
                            </div>
                        </div>
                        <div className="single-feature">
                            <div className="feature-icon">
                            <AiOutlineSafety className='iconColor'/>
                        
                            </div>
                            <div className="feature-details">
                                <h6> PAYMENT MATHOD </h6>
                                <span>100% secured</span>
                            </div>
                        </div>
                        <div className="single-feature">
                            <div className="feature-icon">
                            <BsTruck className='iconColor'/>
                          
                            </div>
                            <div className="feature-details">
                                <h6>FREE SHIPPING</h6>
                                <span>Order over $100</span>
                            </div>
                        </div>
                        <div className="single-feature" style={{borderRight:"none"}}>
                            <div className="feature-icon">
                            <AiOutlineCalendar className='iconColor'/>
                            </div>
                            <div className="feature-details">
                                <h6>30 DAYS RETURN</h6>
                                <span>30 days guarantee</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )

}

export default OrderInfo