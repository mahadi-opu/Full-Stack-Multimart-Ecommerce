import React from 'react'
import './footer.css';
import logo from '../../../src/assets/images/eco-logo.png';
import { Link } from 'react-router-dom';
import { BsLinkedin,BsYoutube,BsFacebook,BsInstagram,BsGithub } from "react-icons/bs";
import { useEffect } from 'react';
import axiosClient from '../../axios-client';
import { useState } from 'react';
import newsletter from "../../assets/images/newsletter.png"
import app1 from "../../assets/images/e-cab-logo-blue.png"
import app2 from "../../assets/images/basis-logo.jpg"
import app3 from "../../assets/images/BKash-Logo.wine.png"
import app4 from "../../assets/images/dutch-bangla-rocket-logo.png"



const Footer = () => {
    const [address,setAddress]=useState('')
    const [phone,setPhone]=useState('')
    const [email,setEmail]=useState('')
    const [facegook,setFacebook]=useState('')
    const [aboutus,setaboutus]=useState('')
    const [privacy,setPrivacy]=useState('')
    const [refund,setRefund]=useState('')
    const [termsCondition,setTermsConditions]=useState('')
    const [shipping,setShipping]=useState('')
    useEffect(()=>{
        axiosClient
        .get("product/company/info")
        .then(({ data }) => {
            setAddress(data.company_address);
            setPhone(data.phone);
            setEmail(data.email);
            setFacebook(data.facebook_link);
            setaboutus(data.about_us);
            setPrivacy(data.privacy_policy);
            setRefund(data.refund_policy);
            setTermsConditions(data.terms_condition);
            setShipping(data.shipping_policy);

            // console.log(data)
            // setProductList(data);
        });
    },[])

//   const year = new Date().getFullYear()

  return (
    <>
    <div style={{width:"100%",overflow:"hidden"}}>
    <footer className='py-5'>
            <div className="container">
                <div className="row align-items-center gx-5">
                    <div className="col-md-5">
                        <div className="footer-top-data">
                            <img src={newsletter} alt="" />
                            <h2> Sign Up for News Letter </h2>
                        </div>
                    </div>
                    <div className="col-md-7">
                        <div className="subscribe-group">
                            <input 
                                type="text" 
                                className="" 
                                placeholder="Your Email Address." 
                                aria-label="Your Email Address." 
                                aria-describedby="basic-addon2"
                            />
                            <span className="subscribe-text p-2" id="basic-addon2"> 
                                Subscribe
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
       
        <footer className='py-4'>
            <div className="container">
                <div className="row">
                    <div className="col-lg-4 col-md-6">
                        <h4 className='text-white mb-4'>Contact Us </h4>
                        <div className='office__info pe-5'>
                            <address>
                             {address}
                            </address>
                            <a className=' text-white mt-3 mb-1' href='tel:+880 1313 450785'> Contact: {phone} </a>
                            <br />
                            <a className=' text-white mt-2 mb-0' href='mailto:hello@reinforcelab.com'> Email: {email} </a>
                            <div className='social_icons d-flex align-items-center gap-15 mt-4'>
                                <Link to=""><BsLinkedin className='fs-5'/></Link>
                                <a href={facegook} target="_blank" ><BsYoutube className='fs-5'/></a>
                                <a href={facegook} target="_blank" ><BsFacebook className='fs-5'/></a>
                                
                                <Link to=""><BsInstagram className='fs-5'/></Link>
                                <Link to=""><BsGithub className='fs-5'/></Link>
                               
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-2 col-md-6">
                        <h4 className='text-white mb-4'> Informetion </h4>
                        <div className='footer-links d-flex flex-column'>

                            {/* <Link className=' text-white py-2 mb-1' to=""> Blogs </Link> */}
                            <Link className=' text-white py-2 mb-1' to={`about/privacy/${privacy}`}> Privacy Policy </Link>
                            <Link className=' text-white py-2 mb-1'  to={`about/shipping/${shipping}`}>  Shipping Policy  </Link>
                            <Link className=' text-white py-2 mb-1'  to={`about/refund/${refund}`}>Refund Policy </Link>
                            <Link className=' text-white py-2 mb-1'  to={`about/terms/condition/${termsCondition}`}> Terms & Conditions </Link>
                        </div>
                    </div>
                    <div className="col-lg-2 col-md-6">
                        <h4 className='text-white mb-4'> Account </h4>
                        <div className='footer-links d-flex flex-column'>
                            <Link className=' text-white py-2 mb-1' to='aboutus/'> About Us  </Link>
                            <Link className=' text-white py-2 mb-1' to="faq/"> Faq </Link>
                            <Link className=' text-white py-2 mb-1' to="contact/us/ll">  Contact  </Link>
                        </div>
                    </div>
                    <div className="col-lg-4 col-md-12">
                        <h4 className='text-white mb-4'> Our Partners </h4>
                        <p className='text-white mb-3'> Download Our App And get Extra 15% Discount on Your first Order...</p>
                        <div className='row flex-wrap gy-3'>
                           <div className='col-lg-4 col-md-4'>
                                <Link className='footer-app-links' to=""> <img src={app1} alt="" />  </Link>
                           </div>
                           <div className='col-lg-8 col-md-8'>
                                <Link className='footer-app-links' to=""> <img src={app2} alt="" />  </Link>
                           </div>
                       
                            <div className='col-lg-4 col-md-4'>
                                <Link className='footer-app-links' to=""> <img src={app3} alt="" />  </Link>
                            </div>
                            <div className='col-lg-8 col-md-8'>
                                <Link className='footer-app-links' to=""> <img src={app4} alt="" /> </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <footer className='py-3'>
            <div className="container">
                <div className="row align-items-center">
                    <div className="col-lg-6 col-md-6">
                            <p className='footer__copyright mb-0 text-white align-items-center'>
                                &copy; {new Date().getFullYear()} Powerd by <Link to="https://reinforcelab.com/"> ReinforceLab Ltd.</Link> All rights reserved </p>
                    </div>
                    <div className="col-lg-6 col-md-6">
                    <div className='footer-payment'>
                            <Link to=""> <img src="header-img/cc-badges-ppmcvdam.png" alt="" />  </Link>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </>

  )
}



export default Footer;