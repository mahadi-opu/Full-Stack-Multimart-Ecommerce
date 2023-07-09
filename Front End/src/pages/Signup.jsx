import React,{useState} from 'react';
import Helmet from '../components/Helmet/Helmet';
import { Link,useHistory,useNavigate } from 'react-router-dom';
import { useDispatch } from 'react-redux';

import { Col, Container, Form, FormGroup, Input, Row } from 'reactstrap';
import '../styles/authentications.css';
import axiosClient from '../axios-client';
import { toast } from "react-toastify";
import { userAction } from '../redux/slices/userSlice';


const Signup = () => {

  const [username,setUserName] = useState();
  const [email,setEmail] = useState();
  const [password,setPassword] = useState();
  const [passwordConfirmation,setpasswordConfirmation] = useState();
  const dispatch = useDispatch();
  const navigate=useNavigate();

  const submitregForm = (e) =>{
    e.preventDefault()
    var data={
      name:username,
      email:email,
      password:password,
      password_confirmation:passwordConfirmation
    }
    axiosClient
    .post('/signup',data)
    .then(({ data }) => {

      if(data.status==422){
        console.log(data.msg)
        toast.error(data.msg,{theme: "colored"});
       }
       if(data.status==200){
        let infodata={
          token:data.token,
          userInfo:data.user,
        }
        dispatch(userAction.setLoginInfo(infodata));
        toast.success('Registration  successfully completed ')
        navigate('/home')
        
       }


       localStorage.setItem('ACCESS_TOKEN',data.token)
       localStorage.setItem('USER_DATA',JSON.stringify(data.user))
    });
  }

  return (
    <Helmet title="Signup">
        <section>
            <Container>
              <Row>
                <Col lg='12' className='login-feture py-5'>
                    <h3 className='fw-bold fs-4 mb-4 text-center'> Sign Up </h3>
                    <div className='d-flex justify-content-center'>
                      <Form className='auth__form' onSubmit={(e)=>submitregForm(e)}>
                          <FormGroup className='form__group'>
                              <Input 
                                type="text"
                                required
                                placeholder='Username'
                                value={username} 
                                onChange={(e) => setUserName(e.target.value)}
                              />
                          </FormGroup>
                          <FormGroup className='form__group'>
                              <Input 
                                type="email"
                                placeholder='Enter Your email'
                                value={email}
                                onChange={(e)=> setEmail(e.target.value)}
                              />
                          </FormGroup>
                          <FormGroup className='form__group'>
                            <Input 
                              type="password" 
                              placeholder='Enter Your password'
                              value={password} 
                              minLength={6}
                              onChange={(e)=> setPassword(e.target.value)} 
                            />
                          </FormGroup>

                          <FormGroup className='form__group'>
                            <Input 
                              type="password" 
                              placeholder='Enter Your password'
                              value={passwordConfirmation} 
                              minLength={6}
                              
                              onChange={(e)=> setpasswordConfirmation(e.target.value)} 
                            />
                          </FormGroup>

                          <FormGroup className='form__group'>
                              <button type='submit' class="auth__btn"> Create an Account</button>
                          </FormGroup>
                          <p> 
                              Alreaady have an account ? {""}  
                              <Link className= 'text-black fw-bold' to="/login"> Login </Link>
                          </p>
                      </Form>
                    </div>
                </Col>
              </Row>
            </Container>
        </section>
    </Helmet>
  )
}

export default Signup;