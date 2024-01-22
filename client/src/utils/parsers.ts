import { currencies } from '@utils/types';

export const parseMoney = (money: number | string, currency: currencies): string => {
  const formatter = new Intl.NumberFormat('pl-PL', {
    currency: currency.toUpperCase(),
    style: 'currency',
  });

  let sanitizedMoney: number;

  if (typeof money === 'string') {
    sanitizedMoney = parseFloat(
      parseFloat(money.replace(' ', '').replace(',', '.')).toFixed(2),
    );
  } else {
    sanitizedMoney = money;
  }

  return formatter.format(sanitizedMoney).replace('GBP', '£').replace('USD', '$');
};
