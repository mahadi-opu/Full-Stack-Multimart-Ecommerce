import mongoose from "mongoose";

const connectDb = async (req, res) => {

    try {
        const connect = await mongoose.connect(process.env.App_Mongo_Connect_String);
        console.log(`Database connect successfully & host - ${connect.connection.host}`)
    } catch (error) {
        console.log({
            errors: error,
            message: "Database connect failed"
        })
    }

}

export default connectDb;