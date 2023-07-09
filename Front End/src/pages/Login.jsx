import React,{useState} from 'react';
import Helmet from '../components/Helmet/Helmet';
import { Link } from 'react-router-dom';
import { useHistory,useNavigate } from 'react-router-dom';
import { Col, Container, Form, FormGroup, Input, Label, Row } from 'reactstrap';
import '../styles/authentications.css';                       
import axiosClient from '../axios-client';
import { useSelector, useDispatch } from "react-redux";
import { userAction } from '../redux/slices/userSlice';
import { toast } from "react-toastify";
import { getWishcount } from '../redux/slices/settingSlice';


const Login = () => {
  const totalAmount = useSelector((state) => state.cart.totalAmount);
  const islogin = useSelector((state) => state.user.islogin);
  const dispatch = useDispatch();
  const [email,setEmail] = useState();
  const [password,setPassword] = useState();
  const [loginError,setloginError] = useState(false);
  const navigate=useNavigate();
  const handleLoginSubmit = e => {   
    e.preventDefault();
  }

  const submitForm = () => {
    const info={
      email:email,
      password:password,
    }
    axiosClient.post("login",info).then(({data})=>{
  
     if(data.status==422){
      setloginError(true)
      toast.error(data.msg,{theme: "colored"});
     }
     if(data.status==200){
      let infodata={
        token:data.token,
        userInfo:data.user,
      }
      dispatch(getWishcount());
      toast.success('Successfully Login')

      navigate('/home')
     }

    })
  }

  return (
    <Helmet title = "Login">
        <section>
            <Container>
              <Row>
                <Col lg='12' className='login-feture py-5'>
                    <h3 className='fw-bold fs-4 mb-4 text-center'> Sign In </h3>
                    <div>
                      
                      <Form className = 'auth__form' onSubmit={handleLoginSubmit}>
                    
                          <FormGroup className='form__group'>
                            <Label> Email address* </Label>
                            <Input className='form-control'
                                   required 
                                   type= "email" 
                                   id='exampleEmail'name='email' 
                                   placeholder='Enter Your Name '
                                   value= {email}
                                   onChange={e=> setEmail(e.target.value)} />
                          </FormGroup>

                          <FormGroup className='form__group'>
                            <Label> Password * </Label>
                            <Input type="password" name='name'
                                   id='examplepass'
                                   required
                                   placeholder='Enter Your password'
                                   value= {password}
                                   onChange={e=> setPassword(e.target.value)} />
                          </FormGroup>
                          {
                            loginError&& <div><h5 className="loinerrtxt"> Provided Email Address or Password is Incorrect </h5> <br/></div> 
                          }
                          

                          <FormGroup className='form__group'>
                              <button onClick={submitForm} class="auth__btn"> Submit </button>
                          </FormGroup>
                          <p> 
                            Don't have an account ? {""}  
                            <Link className= 'text-black fw-bold' to="/Signup">  Create an account </Link>
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

export default Login;