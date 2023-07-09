import React from 'react';
import styles from '../../../Assets/CSS/Filter/Filter.module.css';
const InstructorFilter = () => {
    return (
        <>
            <ul className='list-unstyled mb-0'>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="John Due" /> John Due
                             </label> 
                        </div>
                    </div>
                </li>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="HP Mante" /> HP Mante
                             </label> 
                        </div>
                    </div>
                </li>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="Hela Boeln" /> Hela Boeln
                             </label> 
                        </div>
                    </div>
                </li>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="pitter vowla" /> pitter vowla
                             </label> 
                        </div>
                    </div>
                </li>
                <li>
                    <div className={styles.RattingFilterRawp}>
                        <div>
                             <label> 
                                 <input type="checkbox" id="topping" name="topping" value="Mera camton" /> Mera camton
                             </label> 
                        </div>
                    </div>
                </li>
               
            </ul>
        </>
    );
};

export default InstructorFilter;