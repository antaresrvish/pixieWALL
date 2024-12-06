import { Request, Response } from "express";
import pool from "../../db/index";

async function countClick(req: Request, res: Response) {
    try {
        const result = await pool.query<{ count: number }>(
            "SELECT count FROM click_count"
        );
        res.json(result.rows[0]?.count ?? 0);
    } catch (err: unknown) {
        if (err instanceof Error) {
            res.status(500).json({ error: err.message });
        } else {
            res.status(500).json({ error: "An unknown error occurred" });
        }
    }
}