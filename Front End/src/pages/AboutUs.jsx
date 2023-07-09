import React, { useEffect} from 'react'
import Helmet from '../components/Helmet/Helmet'
import CommonSection from '../components/UI/CommonSection'
import { useParams } from 'react-router-dom';
import AboutImg from '../assets/images/img/Ads-01-01.jpg';
import '../styles/about.css';
import OrderInfo from '../components/UI/OrderInfo';


const AboutUs = () => {
    const {aboutus}=useParams();
    useEffect(()=>{
        window.scrollTo(0, 0);
    })
    // {aboutus}
    return (
        <Helmet title='About Us'>
            <CommonSection title={'About Us'}/>
            <div className="container p-md-5">
                <div className="row p-md-5 g-5 d-flex align-items-center">
                    <div className="col-lg-6 col-md-12">
                       <div className=''>
                            <img src={AboutImg} className="about_img p-3 img-fluid" alt="Bootstrap Themes" loading="lazy"/>
                       </div> 
                    </div>
                    <div className="col-lg-6 col-md-12">
                        <h2 className="display-5  fw-bold text-body-emphasis lh-1 mb-3">Responsive left-aligned hero with image</h2>
                        <p className="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                    </div>
                </div>
                <div className="row py-md-5">
                    <OrderInfo/>
                </div>
            </div>
        </Helmet >
    )
};

export default AboutUs;