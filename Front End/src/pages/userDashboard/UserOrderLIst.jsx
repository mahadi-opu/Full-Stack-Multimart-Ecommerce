import React, { useEffect, useState } from "react";
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
    Badge,
} from "reactstrap";
import {
    AiOutlineHeart,
    AiOutlineShopping,
    AiOutlineCheckCircle,
} from "react-icons/ai";

import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';
import { toast } from "react-toastify";

import Invoice from "../../components/Invoice/Invoice";
import "../../styles/myorderlist.css"

import { Box, Typography } from "@mui/material";



import {
    UncontrolledDropdown,
    DropdownToggle,
    DropdownMenu,
    DropdownItem
} from 'reactstrap'
import axiosClient from "../../axios-client";

import { Modal, ModalHeader, ModalBody, ModalFooter } from 'reactstrap';


const UserOrderList = () => {

    const style = {
        position: 'absolute',
        top: '50%',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        width: 400,
        bgcolor: 'background.paper',
        border: '2px solid #000',
        boxShadow: 24,
        p: 4,
    };




    const [open, setOpen] = React.useState(false);
    const handleOpen = () => setOpen(true);
    const handleClose = () => setOpen(false);
    const [orderList, setOrderList] = useState([]);
    const [orderId, setorderId] = useState(0);
    const [cancelorderId, setcancelorder] = useState(0);

    const [modal, setModal] = useState(false);
    const toggle = () => setModal(!modal);

    const [modal2, setModal2] = useState(false);
    const toggle2 = (id,inv_id) =>{
        setcancelorder(id);
        setModal2(!modal2);

    } 
    const cancelorder=()=>{

        axiosClient.get(`user/order/cancel?order_id=${cancelorderId}`).then(({ data }) => {
            orderlistget();
            toast.success('Order cancellation request sent successfully');
            setModal2(!modal2);
          
        });
    }
    const status = {
        "0": <Badge
            color="danger "
            pill
        >
            Pending
        </Badge>,
        '1': <Badge
            color="info"
            pill
        >
            Processing
        </Badge>,
        "2": <Badge
            color="danger "
            pill
        >
            On the way
        </Badge>,
        '3': <Badge
            color="success"
            pill
        >
            Cancel Request
        </Badge>,
        '4': <Badge
            color="success"
            pill
        >
            Completed
        </Badge>,
        '5': <Badge
            color="success"
            pill
        >
            Completed
        </Badge>,

    }
    let details = (id) => {
        setorderId(id)
        toggle()
    }
    const confirm = () => {
        alert('sdf')
    }
    useEffect(() => {
        orderlistget();
    }, [])

    function orderlistget(){
        axiosClient.get("user/order/list").then(({ data }) => {
            setOrderList(data.data);
        });
    }
    return (
        <Helmet title="Login">
            <section>
                <Container>
                    <h4>My Order</h4>
                    <Row className="dashboardCard">
                        <Col lg="12" className="userProfile__info">
                            <TableContainer component={Paper}>
                                <Table sx={{ minWidth: 650 }} size="small" aria-label="a dense table">
                                    <TableHead>
                                        <TableRow className="tbldeadcolor ">
                                            <TableCell>Order ID</TableCell>
                                            <TableCell align="right">Date</TableCell>
                                            <TableCell align="right">Total Amount</TableCell>
                                            <TableCell align="right">Status</TableCell>
                                            <TableCell align="right">Action</TableCell>
                                        </TableRow>
                                    </TableHead>
                                    <TableBody>
                                        {
                                            orderList.map((data) => {
                                                return <TableRow
                                                    key='dsf'
                                                    sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                                >
                                                    <TableCell component="th" scope="row">
                                                        #{data.invoice_id}
                                                    </TableCell>
                                                    <TableCell align="right">{data.date_format}</TableCell>
                                                    <TableCell align="right">{data.total_payable_amount}</TableCell>
                                                    <TableCell align="right">

                                                        <div>
                                                            {
                                                                status[data.order_status]
                                                            }

                                                        </div>
                                                    </TableCell>
                                                    <TableCell align="right" className="centerst">
                                                        <UncontrolledDropdown
                                                            className="me-2 dbitem"
                                                            direction="start"
                                                        >
                                                            <DropdownToggle
                                                                caret
                                                                color="primary"
                                                                className="dropdownbtnstyle"
                                                            >
                                                                Action
                                                            </DropdownToggle>
                                                            <DropdownMenu className="dropdownitemtxt">
                                                                {/* <DropdownItem header>
                                                                    Header
                                                                </DropdownItem>
                                                                <DropdownItem disabled>
                                                                    Action
                                                                </DropdownItem> */}
                                                                {/* <DropdownItem divider /> */}
                                                                <DropdownItem onClick={() => {
                                                                    details(data.id)
                                                                }}>
                                                                    Details
                                                                </DropdownItem>
                                                                <DropdownItem />
                                                            {data.order_status!==3&&<DropdownItem onClick={()=>toggle2(data.id,data.invoice_id)} >
                                                                    Order Cancel
                                                                </DropdownItem>}
                                                                
                                                            </DropdownMenu>
                                                        </UncontrolledDropdown>
                                                    </TableCell>
                                                </TableRow>
                                            })

                                        }
                                    </TableBody>
                                </Table>
                            </TableContainer>

                        </Col>
                    </Row>
                </Container>
            </section>  


            <Modal isOpen={modal} size="xl" >
                {/* <ModalHeader toggle={toggle}>Modal title</ModalHeader> */}
                <h4 className="orderdetailstx">Order Details</h4>
                <ModalBody>
                    <Invoice order_id={orderId} />
                </ModalBody>
                <ModalFooter style={{ border: "none" }}>
                    {/* <Button color="primary" onClick={toggle}>
                        Do Something
                    </Button>{' '} */}
                    <Button color="secondary" onClick={toggle}>
                        Cancel
                    </Button>
                </ModalFooter>
            </Modal>


            <Modal isOpen={modal2}  toggle={toggle2} className="mrtopset" >
                <ModalHeader  className="cancelmodalhead backgroudcolor" toggle={toggle2}></ModalHeader>
                <ModalBody className="text-center backgroudcolor">
                    Are you sure you want to cancel this order ?
                </ModalBody>
                <ModalFooter className="footerbntsst backgroudcolor">
                    <Button color="primary" className="btnfontsize" onClick={cancelorder}>
                        Yes
                    </Button>{' '}
                    <Button color="secondary" className="btnfontsize" onClick={toggle2}>
                        No
                    </Button>
                </ModalFooter>
            </Modal>







        </Helmet>
    );
};

export default UserOrderList;
