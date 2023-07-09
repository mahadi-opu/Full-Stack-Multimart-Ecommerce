import React, { useEffect, useState } from 'react'
import Helmet from '../components/Helmet/Helmet'
import CommonSection from '../components/UI/CommonSection'
import { Input } from 'reactstrap';
import { useParams } from 'react-router-dom';
import "../styles/contact.css"
import { toast } from "react-toastify";
import { BsTelephonePlusFill,BsWhatsapp } from "react-icons/bs";
import { BiCurrentLocation } from "react-icons/bi";
import { MdEmail } from "react-icons/md";


const ContactUs = () => {
    const { aboutus } = useParams();
    useEffect(() => {
        window.scrollTo(0, 0);
    })

    const [name, setname] = useState('');
    const [email, setemail] = useState('');
    const [text, setptext] = useState('');
    const submitdata = () => {
        setname('');
        setemail('');
        setptext('');
        toast.success('Successfully message send');
    }


    return (
        <Helmet title='Contact Us'>
            <CommonSection title={'Contact Us'} />
            {/* <Container>
                <div className="row mt-5 mb-5 maindiv">
                    <div className="col-sm-6 locationBackground">
                        <div className='addressinfo'>
                            <div className='infoflex'>
                                <div className='titlewidth'> <span className='icondata'><AiOutlinePhone /></span> <span classNameName='title_tx'>Phone</span> </div>
                                <p className='titleinfowidth'>0179297777</p>
                            </div>

                            <div className='infoflex'>
                                <div className='titlewidth'> <span className='icondata'><AiOutlineMail /></span> <span classNameName='title_tx'>Email</span></div>
                                <p className='titleinfowidth'>dfh@gmail.com</p>
                            </div>
                            <div className='infoflex'>
                                <div className='titlewidth'> <span className='icondata'><AiOutlineEnvironment /></span> <span classNameName='title_tx'>Location</span> </div>
                                <p className='titleinfowidth'>medium-emphasis buttons. They contain actions that are important but aren't the primary</p>
                            </div>


                        </div>
                    </div>
                    <div className="col-sm-6 rightbackground">
                        <div className='coutactinputdiv'>
                            <FormGroup>
                                <Input className='inputtxtsiz' value={name} onChange={ev => setname(ev.target.value)} type="text" name="email" id="exampleEmail" placeholder="Name" required />
                            </FormGroup>
                            <FormGroup>
                                <Input classNameName='inputtxtsiz' value={email} onChange={ev => setemail(ev.target.value)} type="email" name="email" id="exampleEmail" placeholder="Email" />
                            </FormGroup>
                            <FormGroup>
                                <textarea className='form-control inputtxtsiz' value={text} onChange={ev => setptext(ev.target.value)} rows={5} col={20}> </textarea>
                            </FormGroup>


                            <Button type='submit' onClick={submitdata} variant="contained" className='sendbtn'  >
                                Send
                            </Button>

                        </div>



                    </div>
                </div>


            </Container> */}
            <div className="container px-4 py-5">
                <div className="row row-cols-1 row-cols-md-2 align-items-md-center g-5">
                    <div className="col-md-12 mx-auto col-lg-6 m-0">
                        <div className="row row-cols-1 row-cols-sm-2 g-4">
                        
                        <div class="col d-flex align-items-start">
                            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                                <svg class="bi" width="1em" height="1em"> <BsTelephonePlusFill/></svg>
                            </div>
                            <div>
                            <h4 className="fw-semibold mb-0 text-body-emphasis"> Phone: </h4>
                            <p className="text-body-secondary"> +880 1329-657096 </p>
                            </div>
                        </div>
                        <div class="col d-flex align-items-start">
                            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                                <svg class="bi" width="1em" height="1em"> <MdEmail/></svg>
                            </div>
                            <div>
                            <h4 className="fw-semibold mb-0 text-body-emphasis">Email: </h4>
                            <p className="text-body-secondary">hello@reinforcelab.com</p>
                            </div>
                        </div>

                        <div class="col d-flex align-items-start">
                            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                                <svg class="bi" width="1em" height="1em"> <BiCurrentLocation/></svg>
                            </div>
                            <div>
                            <h4 className="fw-semibold mb-0 text-body-emphasis"> Location:</h4>
                            <p className="text-body-secondary"><b>Reinforce Lab Ltd</b>,<br/>
    Suite #302, Level-3, Concord Tower, 113 Kazi Nazrul Islam Avenue, Dhaka - 1000,  Bangladesh</p>
                            </div>
                        </div>

                        <div class="col d-flex align-items-start">
                            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                                <svg class="bi" width="1em" height="1em"> <BsWhatsapp/></svg>
                            </div>
                            <div>
                            <h4 className="fw-semibold mb-0 text-body-emphasis">Whatsapp </h4>
                            <p className="text-body-secondary"> +880 1329-657096 </p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div className="col-md-12 mx-auto col-lg-6">
                            <form className="p-3 p-md-5 border rounded-0 bg-body-tertiary">
                                <div className="form-floating mb-3">
                                    <Input className='inputtxtsiz' value={name} onChange={ev => setname(ev.target.value)} type="text" name="email" id="exampleEmail" placeholder="Name" required />
                                    <label for="floatingInput">Name</label>
                                </div>
                                <div className="form-floating mb-3">
                                    <Input classNameName='inputtxtsiz' value={email} onChange={ev => setemail(ev.target.value)} type="email" name="email" id="exampleEmail" placeholder="Email" />
                                    <label for="floatingInput">Email </label>
                                </div>
                                <div className="form-floating mb-3">
                                    <textarea className='form-control inputtxtsiz'value={text} rows="10" onChange={ev => setptext(ev.target.value)}> </textarea>
                                    <label for="floatingPassword">Input your Massage </label>
                                </div>
                                <button onClick={submitdata} className="w-100 btn btn-lg btn-primary" type="submit"> Send </button>
                            </form>
                    </div>                    
                </div>
            </div>
        </Helmet >
    )
};

export default ContactUs;