import {
  AMOUNTS_KEYS,
  FOREIGN_AMOUNTS_KEYS,
  MONEY_VALUES,
  ZLOTY_AMOUNTS_KEYS,
  sum,
} from '@/utils';

const testData = {
  amounts: {
    count_1gr: 1,
    count_2gr: 1,
    count_5gr: 1,
    count_10gr: 1,
    count_20gr: 1,
    count_50gr: 1,
    count_1zl: 1,
    count_2zl: 1,
    count_5zl: 1,
    count_10zl: 1,
    count_20zl: 1,
    count_50zl: 1,
    count_100zl: 1,
    count_200zl: 1,
    count_500zl: 1,
    amount_EUR: 1,
    amount_USD: 1,
    amount_GBP: 1,
  },
  comment: '',
  additional_comment: ''
};

describe('Sum function', () => {
  it('Addition all zloty money', () => {
    const testSum = sum(testData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES);
    expect(testSum).toEqual(888.88);
  });
  it('Addition all foreign money', () => {
    const testSum = sum(testData, FOREIGN_AMOUNTS_KEYS, MONEY_VALUES);
    expect(testSum).toEqual(14.57);
  });
  it('Addition all money', () => {
    const testSum = sum(testData, AMOUNTS_KEYS, MONEY_VALUES);
    expect(testSum).toEqual(903.45);
  });
});
