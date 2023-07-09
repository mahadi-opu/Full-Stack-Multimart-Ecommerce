import React from 'react'
import BrandImg from '../../assets/images/brands/brand.png';
import Helmet from '../Helmet/Helmet';
import CommonSection from '../UI/CommonSection';

function Brands() {
  return (
    <Helmet title='All Brands'>
    <CommonSection title={'All Brands '}/>
  
        <div className='container'>
            
            <div className='row mt-3'>
                <div className="col-md-12">
                    <div className="p-4 bg-white my-2 rounded border">
                        <div><h2> All Brands </h2></div>
                    </div>
                </div>
            </div>

            <div className='row'> 
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
            </div>

            <div className='row'> 
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
            </div>

            <div className='row'> 
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
                <div className='col-md-2'>
                    <div className="card">
                        <img src={BrandImg} alt="" />
                    </div>
                </div>
            </div>

        </div>
    </Helmet>
  )
}

export default Brands;