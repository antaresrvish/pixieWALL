import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:3000',
    timeout: 5000,
});

export const fetchCells = async () => {
    try {
        const response = await api.post('/hucre_kontrol');
        return response.data;
    } catch (error) {
        console.error('Error fetching cells:', error);
        throw new Error('Could not fetch cells');
    }
};

export const updateCell = async (hucre: string, renk: string) => {
    try {
        const response = await api.post('/renk_guncelle', { hucre, renk });
        return response.data;
    } catch (error) {
        console.error('Error updating cell color:', error);
        throw new Error('Could not update cell color');
    }
};

export const fetchClickCount = async () => {
    try {
        const response = await api.post('/tiklama_sayisi');
        return response.data;
    } catch (error) {
        console.error('Error fetching click count:', error);
        throw new Error('Could not fetch click count');
    }
};
