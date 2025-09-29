// Given an array of integers nums and an integer target, return indices of the two numbers such that they add up to target.
// You may assume that each input would have exactly one solution, and you may not use the same element twice.
// You can return the answer in any order.

var nums = [3, 2, 4];
var target = 6;
let index,
  index2 = 0;
let found = false;
if (
  2 <= nums.length <= 104 ||
  -109 <= nums[i] <= 109 ||
  -109 <= target <= 109
) {
  for (let i = 0; i < nums.length; i++) {
    for (let j = i + 1; j < nums.length; j++) {
      if (nums[i] + nums[j] == target) {
        found = true;
        index = i;
        index2 = j;
        break;
      }
    }
  }
} else {
  console.log("Wrong value !");
}

if (found) {
  console.log("[" + index + "," + index2 + "]");
}
