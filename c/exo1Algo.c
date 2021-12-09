#include <stdio.h>
#include <string.h>
int sumNumber(int array[],int n) // Do Sum of number
{
    int sum = 0;
    for(int i=0; i < n; i++) // Do the sum for n notes
    {
        sum += array[i];
    }
    return sum;
}
int main(void)
{
    int arrayNotes[] = {1,1,1,1,10,1}; // Init notes
    int numberNotes = sizeof(arrayNotes)/sizeof(arrayNotes[0]); // Get size of arrayNotes
    int sumRes = sumNumber(arrayNotes,numberNotes); // Exec sumNumberFunction and get sum
    printf("%d\n",sumRes); //print sum of notes
    return 0;
}
