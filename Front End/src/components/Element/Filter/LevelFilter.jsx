import React from 'react';
import styles from '../../../Assets/CSS/Filter/Filter.module.css';

const LevelFilter = () => {
    return (
        <>
            <ul className='list-unstyled mb-0'>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="Beginner" /> Beginner (258)
                             </label> 
                        </div>
                    </div>
                </li>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="John Due" /> Intermediate (57)
                             </label> 
                        </div>
                    </div>
                </li>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="John Due" />Expert (142) 
                             </label> 
                        </div>
                    </div>
                </li>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="John Due" /> All levels
                             </label> 
                        </div>
                    </div>
                </li>
       
            </ul>
        </>
    );
};

export default LevelFilter;