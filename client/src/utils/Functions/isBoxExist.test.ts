import { isBoxExists } from './isBoxExist';

describe('isBoxExists', () => {
  it('should return true if the box exists', () => {
    expect(
      isBoxExists('testCollectorName', 'testCollectorIdentifier', 'testBoxIdentifier'),
    ).toBeTruthy();
  });
  it('should return false if at least one info is null', () => {
    expect(isBoxExists('testCollectorName', 'testCollectorIdentifier', null)).toBeFalsy();
  });
});
