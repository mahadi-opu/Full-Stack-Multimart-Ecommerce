import React from 'react';
import "./App.css";
import Layout from "./components/Layout/Layout";
import {QueryClient,QueryClientProvider} from "react-query";


function App() {
  let queryclient= new QueryClient()
  return (
    <>
     <QueryClientProvider client={queryclient}>
      <Layout/>
      </QueryClientProvider>
    </>
  );
};

export default App;
