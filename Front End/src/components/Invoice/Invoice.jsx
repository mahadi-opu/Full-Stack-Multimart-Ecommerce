import React from 'react'
import { useState } from 'react'
import { Table,thead,Row,Col} from 'reactstrap'
import axiosClient from '../../axios-client';
import { useEffect } from 'react';

const Invoice = (props) => {

    let [orderInfo,setOrderInfo]=useState([]);
    const [orderAddreess, setorderAddress] = useState([]);
    const [invoiceId, setIncoiceId] = useState("");
    const [invoiceDate, setIncoiceDate] = useState("");
    const [sellDetails, setSellDetails] = useState([]);
    useEffect(() => {

        if(props.order_id>0){
            axiosClient.get(`user/order/details/by/orderId?id=${props.order_id}`).then(({ data }) => {

            
                setorderAddress(data.data[0].orderAddress);
                setIncoiceId(data.data[0].invoice_id)
                setIncoiceDate(data.data[0].date_format)
                setSellDetails(data.data[0].sellDetails)
                setOrderInfo(data.data[0])
                console.log(data.data[0]);
                // shipping_address
            
                // setOrderInfo(data)
            });
        }
       
    }, [])
  return (
    <div className='w-100 set-invpd'>
       
  <Row>
    <Col
      className=""
      xs="6"
    >
  
     <ul style={{textAlign: "left",paddingLeft: "0px"}}>
        <li>
        <h6> <strong>Shipping Address</strong> </h6>
        </li>
        <li>
       {orderAddreess.name}
        </li>
        <li>
            <span>{orderAddreess.shipping_address}</span>
        </li>
        <li>
            <span>Phone:</span> <span>{orderAddreess.shipping_phone}</span>
        </li>
        <li>
            <span>Email:</span> <span>{orderAddreess.email}</span>
        </li>
     
     </ul>
    </Col>
    <Col
      className=""
      xs="6"
    >
       <ul style={{textAlign: "right"}}>
        {/* <li>
        <h6>Shipping Address</h6>
        </li> */}
        <li>
            <strong>Invoice: #{invoiceId}</strong>
        </li>
        <li>
            <span>Date: {invoiceDate}</span>
        </li>
        {/* <li>
            <strong>Phone:</strong> <span>01792323423</span>
        </li>
        <li>
            <strong>Email:</strong> <span>msdf@gamil.com</span>
        </li> */}
     
     </ul>
    </Col>
 
  </Row>

<Table className='tablesst mt-4' >
  <thead >
    <tr className='tbcolorst'>
      <th>
        SI
      </th>
      <th>
        Name
      </th>
      <th>
      QTY
      </th>
      <th>
      UNIT PRICE
      </th>
      <th>
      AMOUNT
      </th>
    </tr>
  </thead>
  <tbody>
    {
        sellDetails.map((data,index)=>{
            return <InvoiceDetails data={data} si={index+1}/>
        })
    }



    <tr>
      <th colSpan={3}>
      </th>
      <td className='textright_st'>
      <strong>Subtotal:</strong>
      </td>
      <td className='flotlert-set'>
        { Math.round(orderInfo.total_payable_amount) }
      </td>
    </tr>

    <tr>
      <th colSpan={3}>
      </th>
      <td className='textright_st'>
      <strong>Vat :</strong>
       
      </td>
      <td className='flotlert-set'>
        0
      </td>
    </tr>
    <tr>
      <th colSpan={3}>
      </th>
      <td className='textright_st'>
      <strong>Shipping :</strong>
      </td>
      <td className='flotlert-set'>
        0
      </td>
    </tr>
    <tr className='borderTopsst'>
      <th colSpan={3}>
      </th>
      <td className='textright_st'>
        <strong>Total :</strong>
       
      </td>
      <td className='flotlert-set'>
        <strong> { Math.round(orderInfo.total_payable_amount) }</strong>
     
      </td>
    </tr>

  </tbody>
</Table>
    </div>
  )
}

const InvoiceDetails=(props)=>{
    return  ( <tr>
    <th scope="row">
      {props.si}
    </th>
    <td style={{width:"40%"}}>
      {props.data.product_name}
    </td>
    <td >
    {props.data.sale_quantity}
    </td>
    <td >
    { Math.round(props.data.unit_sell_price-props.data.total_discount) }
    </td>
    <td style={{width:"10%"}} className='flotlert-set'>
      {props.data.total_payable_amount}
    </td>
  </tr>)

}

export default Invoice