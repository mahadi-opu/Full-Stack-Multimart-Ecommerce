import React from 'react';
import { Button } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import styles from '../../../Assets/CSS/Partials/Button.module.css'

const LearnMore = ({name,Customurl}) => {
    return (
        <>
            <div className={styles.learnMoreBtn}>
                <Button>
                    <Link to={Customurl}> {name} </Link>
                </Button>
            </div>
        </>
    );
};

export default LearnMore;