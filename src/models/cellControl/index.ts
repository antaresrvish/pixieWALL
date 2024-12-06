import { Request, Response } from 'express';
import pool from "../../db/index";
import Cell from '../../types/cell';

async function cellControl(req: Request, res: Response) {
  try{
    const result = await pool.query<Cell>('SELECT hucre, renk FROM pixwall');
    res.json(result.rows);
  } catch (err: unknown) {  
    if (err instanceof Error) {
      res.status(500).json({ error: err.message });
    } else {
      res.status(500).json({ error: 'An unknown error occurred' });
    }
  }
}