import { DisplayAbleData, IUnverifiedBoxes } from '../types';

export const createDisplayAbleData = (data: IUnverifiedBoxes[]) => {
  const displayAbleData = [];

  for (const item of data) {
    const name = `${item.collector.firstName} ${item.collector.lastName}`;

    console.log(item);

    displayAbleData.push({
      id: item.id,
      name: name,
      amount_EUR: item.amount_EUR,
      amount_GBP: item.amount_GBP,
      amount_USD: item.amount_USD,
      amount_PLN: item.amount_PLN,
      comment: item.comment,
      time_counted: item.time_counted,
    });
  }

  return displayAbleData as DisplayAbleData[];
};
