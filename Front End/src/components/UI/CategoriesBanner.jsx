import React from 'react';
import { Link } from 'react-router-dom';
import cat1 from '../../assets/images/category/cat-12.jpg'
import cat2 from '../../assets/images/category/Home Appliances.jpg'
import cat3 from '../../assets/images/category/Health & Beauty.jpg'
import cat4 from '../../assets/images/category/Electronic Devices.jpg'
import '../../styles/categoriesbanner.css'
import { Container } from 'reactstrap';
import { useSelector } from 'react-redux';




const CategoriesBanner = (props) => {
    const basepath = useSelector((state) => state.setting.basepath);
    return (
        // <>
        //   <div className="flex">
        //     <div className='cardflx'>
        //     <div className='card'>
        //                 <div className='category__img'>
        //                     <img src={cat1} alt="Image"/>
        //                 </div>
        //                 <div className='category_link'>
        //                     <Link to={`/products/list`} > Babies & Toys </Link>
        //                 </div>
        //            </div>

        //     </div>
        //     <div className='cardflx'>
        //     <div className='card'>
        //                 <div className='category__img'>
        //                     <img src={cat1} alt="Image"/>
        //                 </div>
        //                 <div className='category_link'>
        //                     <Link to={`/products/list`} > Babies & Toys </Link>
        //                 </div>
        //            </div>

        //     </div>
        //     <div className='cardflx'>
        //     <div className='card'>
        //                 <div className='category__img'>
        //                     <img src={cat1} alt="Image"/>
        //                 </div>
        //                 <div className='category_link'>
        //                     <Link to={`/products/list`} > Babies & Toys </Link>
        //                 </div>
        //            </div>

        //     </div>
        //     <div className='cardflx'>
        //     <div className='card'>
        //                 <div className='category__img'>
        //                     <img src={cat1} alt="Image"/>
        //                 </div>
        //                 <div className='category_link'>
        //                     <Link to={`/products/list`} > Babies & Toys </Link>
        //                 </div>
        //            </div>

        //     </div>
        //     <div className='cardflx'>
        //     <div className='card'>
        //                 <div className='category__img'>
        //                     <img src={cat1} alt="Image"/>
        //                 </div>
        //                 <div className='category_link'>
        //                     <Link to={`/products/list`} > Babies & Toys </Link>
        //                 </div>
        //            </div>

        //     </div>


        // </div>
        // </>

 

        <div className='cate__cards'>
            {props.categorydata.map((data,index) => {
             return   <div className='cate__card'>
                    <div className='category__img'>
                        <img src={`${basepath}/${data.image}`} alt="Image" />
                
                    </div>
                    <div className='category_link'>
                        <Link to={`/products/list`} >{data.name} </Link>
                    </div>
                </div>

            })}

        </div>
    );
};

export default CategoriesBanner;