import { Request, Response } from "express";
import pool from "../../db/index";

async function updateColor(req: Request, res: Response) {
    const { hucre, renk }: { hucre: string; renk: string } = req.body;
    try {
        await pool.query('UPDATE pixwall SET renk = $1 WHERE hucre = $2', [renk, hucre]);
        await pool.query('UPDATE click_count SET count = count + 1');
        res.send('ok');
    } catch (err: unknown) {
        if (err instanceof Error) {
            res.status(500).json({ error: err.message });
        } else {
            res.status(500).json({ error: 'An unknown error occurred' });
        }
    }
}