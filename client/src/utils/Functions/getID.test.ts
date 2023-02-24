import { getID } from './getID';

it('should return correct id', () => {
  expect(getID('test01')).toEqual(1);
});
it('should return NaN if no breadman', () => {
  expect(getID('superadmin')).toEqual(NaN);
});
