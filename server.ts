import express , { Request, Response } from "express";

const app  = express();
const PORT = process.env.EXPRESS_PORT || 3000;
app.use(express.json());

app.get("/", (req: Request, res: Response) => {
    res.send("PixieWall API");
});

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});