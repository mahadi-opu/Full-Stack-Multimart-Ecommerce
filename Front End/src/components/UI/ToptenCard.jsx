import React from 'react'
import { MdKeyboardArrowRight } from "react-icons/md";
import pimg from '../../assets/images/arm-chair-01.jpg';
import '../../styles/top10card.css';
import { Link } from 'react-router-dom';



function Top10Card(props) {
const image=props.image
const name=props.name
const type=props.type
const categoryId=props.category_id
  return (
    <div className="card">
        <div className="d-flex justify-content-between align-items-center">
            <div className='top10_images'>
                <img src={image} alt="Image"/>
            </div>
            <div className='top10_category'>
                <Link to=""> {name} </Link>
            </div>
            <div className='top10_arraw'> 
                <Link to=""> <MdKeyboardArrowRight/> </Link>
            </div>
        </div>
    </div>
  )
}

export default Top10Card;