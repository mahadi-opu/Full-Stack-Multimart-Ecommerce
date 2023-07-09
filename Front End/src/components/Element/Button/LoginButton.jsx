import React from 'react';
import { Button } from 'react-bootstrap';
import styles from '../../../Assets/CSS/LoginButton.module.css';


const LoginButton = () => {
    return (
        <div>
                <Button className={styles.loginBtn} variant='disabled'>Log in</Button> 
        </div>
    );
};

export default LoginButton;