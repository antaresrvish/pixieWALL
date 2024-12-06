import { Pool } from "pg";

const pool = new Pool({
  user: process.env.PG_USER || "",
  host: process.env.PG_HOST || "localhost",
  database: process.env.PG_DATABASE || "",
  password: process.env.PG_PASSWORD || "",
  port: Number(process.env.PG_PORT) || 5432, 
});

export const connectToDatabase = async () => {
  try {
    const client = await pool.connect();
    console.log("Connected to PostgreSQL database.");
    return client;
  } catch (err) {
    console.error("Error connecting to PostgreSQL database:", err);
    throw err;
  }
};

export default pool;
