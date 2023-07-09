import React, { useEffect, useState } from 'react'
import Helmet from '../../components/Helmet/Helmet';
import CommonSection from '../../components/UI/CommonSection';
import { useParams } from 'react-router-dom';



const Refund = () => {
    const {refund}=useParams();

    useEffect(()=>{
        window.scrollTo(0, 0);
    })
   
    return (
        <Helmet title='Shop'>
            <CommonSection title={'Refund Policy'}/>
            <div className='container'> 
                <div className='row my-3'>
                    <div className="col-md-12">
                        <div className="p-5 bg-white my-2 rounded border">
                           <p> {refund}</p>
                        </div>
                    </div>
                </div>
            </div>
        </Helmet >
    )
};

export default Refund;