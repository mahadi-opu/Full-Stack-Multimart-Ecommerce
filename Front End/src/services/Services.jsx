import React from 'react'
import { Col,Row, Container } from 'reactstrap'
import './Services.css';

import serviceData from '../assets/data/serviceData';
import {motion} from 'framer-motion';


const Services = () => {
  return (
    <div className='services'>  
        <Container>
            <Row>
                {
                serviceData.map((service,index)=>(
                    <Col lg='3' md='4' key={index}>
                        <motion.div
                            whileHover={{ scale:1.1}}
                            className="service__item"
                            style={{background: `${service.bg}`}} >
                            <span>
                                <i class={service.icon}></i>
                            </span>
                            <div>
                                <h3>{service.title}</h3>
                                <p> {service.subtitle}</p>
                            </div>
                        </motion.div>
                    </Col>
                ))
                }
            </Row>
        </Container>
    </div>
    
  )
}

export default Services;