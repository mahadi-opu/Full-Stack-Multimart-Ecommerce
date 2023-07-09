import React, { useState } from "react";
import Helmet from "../../components/Helmet/Helmet";
import { Link } from "react-router-dom";
import {
    Col,
    Container,
    Form,
    FormGroup,
    Input,
    Label,
    Row,
    Button,
    FormText,
} from "reactstrap";
import { toast } from "react-toastify";


import {
    AiOutlineHeart,
    AiOutlineShopping,
    AiOutlineCheckCircle,
} from "react-icons/ai";
import axiosClient from "../../axios-client";

const ChangePassword = () => {
    const [currentPass,setCurrentPass]=useState('');
    const [newPass,setNewPass]=useState('');
    const [confirmPass,setConfirmPass]=useState('');
    const [confirmError,setConfirmError]=useState(false);

    const changePassword=()=>{
        let data={
            currentPass:currentPass,
            newPass:newPass,
            confirmPass:confirmPass
        }
        if(newPass!==confirmPass){
            setConfirmError(true);
        }else{
            axiosClient
            .post('user/changePassword', data)
            .then(({ data }) => {
                if(data.status==400){
                    toast.error(data.msg)
                }
                if(data.status==200){
                    toast.success(data.msg)
                }
               
            });
        }
      

    }
    return (
        <Helmet title="Login">
            <section>
                <Container>
                    <Form>
                    <Row className="dashboardCard">
                       
                        <Col lg="12" className="userProfile__info">
                            <FormGroup className="frmwidth-st">
                            <h5 className="txcenterst">Change Password</h5>
                    
                            </FormGroup>
                        </Col>
            
                        <Col lg="12" className="userProfile__info">
                            <FormGroup className="frmwidth-st">
                                <Label for="exampleEmail">Current Password</Label>
                                <Input type="password" name="current_password" onChange={(e)=>setCurrentPass(e.target.value)} id="exampleEmail" placeholder="Current Password" />
                            </FormGroup>
                        </Col>
                        <Col lg="12" className="userProfile__info">
                        <FormGroup className="frmwidth-st">
                                <Label for="exampleEmail">New Password</Label>
                                <Input type="password" name="new_password" onChange={(e)=>setNewPass(e.target.value)} id="exampleEmail" placeholder="New Passoerd" />
                            </FormGroup>
                        </Col>
                        <Col lg="12" className="userProfile__info">
                            <FormGroup className="frmwidth-st">
                                <Label for="exampleEmail">Confirm Password</Label>
                                <Input type="password" name="confirm_password" id="exampleEmail" onChange={(e)=>setConfirmPass(e.target.value)} placeholder="Confirm Password" />
                              
                              
                              {confirmError&&<span className="errortx">Password do not match</span>}
                                
                            </FormGroup>
    
                        </Col>
                        <Col lg="12" className="userProfile__info">
                        <Button color="info" className="frmwidth-st passbtn-st" onClick={changePassword}>Save Change</Button>
                        </Col>
                    </Row>
                    </Form>
                </Container>
            </section>
        </Helmet>
    );
};

export default ChangePassword;