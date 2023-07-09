import React from 'react';
import './search.css';



const Search = () => {


  return (
    <>
        <div className='nav_search_box'>
            <div className='search_category'>
                <span>All Category</span>
            </div>

            <div className='search_input'>
                <input type='text' placeholder='Search and hit enter...' />
                <i class="ri-search-line"></i> 
            </div>
        </div>
    </>
  )
}

export default Search;