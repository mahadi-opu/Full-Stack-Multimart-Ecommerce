import React from 'react';
import { Form } from 'react-bootstrap';
import styles from'../../../Assets/CSS/Filter/Filter.module.css';

const IndicatorFilter = () => {

    
    return (
        <>
            <div className={styles.priceRange}>
                <Form.Label> 500TK </Form.Label>
                <Form.Label> 5.000Tk </Form.Label>
            </div>
            <div className={styles.priceRangeIndicator}>
                <input type="range" class="form-range" min="0" max="20" id="customRange1"></input>
            </div>
            
        </>
    );
};

export default IndicatorFilter;