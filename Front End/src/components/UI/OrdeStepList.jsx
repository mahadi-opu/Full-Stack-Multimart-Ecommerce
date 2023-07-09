import React, { useEffect, useState } from "react";
import { Col, Container, Form, FormGroup, Row, Input } from "reactstrap";
import { AiOutlineRight,AiOutlineShoppingCart,AiOutlineIdcard,AiOutlineCreditCard} from "react-icons/ai";
import { useSelector,} from "react-redux";
import '../../styles/order-step.css';
import { toast } from "react-toastify";



const OrderStepList=(props)=>{
    const [activicon,setActiveicon]=useState(0);

    const isLogin=useSelector((state)=>state.user.isLogin)
    const totalQuantity = useSelector((state) => state.cart.totalQuantity);
    const cardStepSet=(data)=>{
        if(data>0 && !isLogin){
            toast.error('Login First')
            return false;
        }
        if(data>0){
          if(totalQuantity<=0){
            toast.error('First add to cart')
            return false;
        }
        }
      
            setActiveicon(data)
            props.action(data)
        
 
    }

    useEffect(()=>{
        cardStepSet(props.activitem);
        console.log(props.activitem);
    
    },[])
    return<Container>
    <div className="shadow-sm p-4 stpitbgcolor">
      <Row>
        <Col mb="4" className="stpitcolor">
        <span className={`order_step_icon ${activicon>=0&&'activIcon'}`} onClick={()=>cardStepSet(0)}><AiOutlineShoppingCart/></span>
          {/* <span className="stp__it"> Cart</span> */}
          <span className="stp__it"> ....... </span>
          {/* <span className="arst">
            <AiOutlineRight />
          </span> */}
    
          <span className={`order_step_icon ${activicon>=1&&'activIcon'}`} onClick={()=>cardStepSet(1)}><AiOutlineIdcard/></span>
          <span className="stp__it"> ....... </span>
       
          
          {/* <span className="arst">
            <AiOutlineRight />
          </span> */}
          <span className={`order_step_icon ${activicon>=2&&'activIcon'}`} onClick={()=>cardStepSet(2)}><AiOutlineCreditCard/></span>
          {/* <span className="stp__it">Payment</span> */}
       
        </Col>
      </Row>
    </div>
  </Container>

}

export default OrderStepList;