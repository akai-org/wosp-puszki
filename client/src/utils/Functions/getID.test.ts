import { getIDfromUsername } from './getIDfromUsername';

it('should return correct id', () => {
  expect(getIDfromUsername('test01')).toEqual(1);
});
it('should return NaN if no breadman', () => {
  expect(getIDfromUsername('superadmin')).toEqual(NaN);
});
