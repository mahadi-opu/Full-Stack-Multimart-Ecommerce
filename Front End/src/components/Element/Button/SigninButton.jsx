import React from 'react';
import { Button } from 'react-bootstrap';
import styles from '../../../Assets/CSS/SigninButton.module.css';


const SigninButton = () => {
    return (
        <div>
            <Button className={styles.signinBtn}>Sign in </Button> 
        </div>
    );
};

export default SigninButton;